<?php

namespace Webkul\B2BSuite\Http\Controllers\Shop\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\B2BSuite\Repositories\CustomerQuoteItemRepository;
use Webkul\CartRule\Repositories\CartRuleCouponRepository;
use Webkul\Checkout\Facades\Cart;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Shop\Http\Controllers\API\CartController as BaseCartController;
use Webkul\Shop\Http\Resources\CartResource;

class CartController extends BaseCartController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerQuoteItemRepository $customerQuoteItemRepository)
    {
        parent::__construct(app(ProductRepository::class), app(CartRuleCouponRepository::class));

        $this->customerQuoteItemRepository = $customerQuoteItemRepository;
    }

    /**
     * Updates the quantity of the items present in the cart.
     */
    public function update(): JsonResource
    {
        try {
            $data = request()->input();

            $cart = Cart::getCart();

            foreach ($data['qty'] as $cartItemId => $quantity) {
                $cartItem = $cart->items->where('id', $cartItemId)->first();

                if (! $cartItem) {
                    continue;
                }

                $additional = $cartItem->additional;

                if (isset($additional['quote_id']) && isset($additional['quote_item_id'])) {
                    $negotiation = $this->customerQuoteItemRepository
                        ->where('id', $additional['quote_item_id'])
                        ->where('customer_quote_id', $additional['quote_id'])
                        ->first();

                    if ($negotiation && $quantity != $negotiation->negotiated_qty) {
                        return new JsonResource([
                            'message' => trans('b2b_suite::app.shop.checkout.cart.cannot-change-negotiated-quantity'),
                        ]);
                    }
                }
            }

            Cart::updateItems($data);

            return new JsonResource([
                'data'    => new CartResource(Cart::getCart()),
                'message' => trans('shop::app.checkout.cart.index.quantity-update'),
            ]);

        } catch (\Exception $exception) {
            return new JsonResource([
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
