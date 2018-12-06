<form action="{{ route('subscriptions.process_subscription') }}" method="POST">
        @csrf
        {{-- <input class="form-control" name="coupon" placeholder="{{ __("¿Tienes un cupón?") }}"/>
        <input type="hidden" name="type" value="{{ $product['type'] }}" /> --}}
        <input type="hidden" name="type" value="monthly">
        <input class="form-control" name="coupon" placeholder="{{ trans('app.subscription.coupon')}}">
        <input type="hidden" name="plan" value="prod_E5YEDixdO3J2TM"> 
        <hr />
        <stripe-form
            stripe_key="{{ env('STRIPE_KEY') }}"
            name="{{ $product['name'] }}"
            amount="{{ $product['amount'] }}"
            description="{{ $product['description'] }}"
        ></stripe-form>
    </form>