@extends('layouts.main')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div id="success" style="display:none" class="col-md-8 text-center h3 p-4 bg-success text-light rounded">book
                bought</div>
            @if (session('message'))
                <div class="col-md-8 text-center h3 p-4 bg-success text-light rounded">book bought</div>
            @endif

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Cart </div>

                    <div class="card-body">

                        @if ($items->count())
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">title</th>
                                        <th scope="col">price</th>
                                        <th scope="col">quantity</th>
                                        <th scope="col">total price</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                @php($totalPrice = 0)
                                @foreach ($items as $item)
                                    @php($totalPrice += $item->price * $item->pivot->number_of_copies)

                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $item->title }}</th>
                                            <td>{{ $item->price }} $</td>
                                            <td>{{ $item->pivot->number_of_copies }}</td>
                                            <td>{{ $item->price * $item->pivot->number_of_copies }} $</td>
                                            <td>
                                                <form style="float:left; margin: auto 5px" method="post"
                                                    action="{{ route('cart.remove_all', $item->id) }}">
                                                    @csrf
                                                    <button class="btn btn-outline-danger btn-sm" type="submit">remove all
                                                    </button>
                                                </form>

                                                <form style="float:left; margin: auto 5px" method="post"
                                                    action="{{ route('cart.remove_one', $item->id) }}">
                                                    @csrf
                                                    <button class="btn btn-outline-warning btn-sm" type="submit"> remove
                                                        one
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>

                            <h4 class="mb-5"> total price {{ $totalPrice }} $</h4>

                            <!-- Set up a container element for the button -->
                            <div class="d-inline-block" id="paypal-button-container"></div>
                            <a href="{{ route('credit.checkout') }}" class="d-inline-block mb-4 float-start btn bg-cart"
                                style="text-decoration:none;">
                                <span> credit card</span>
                                <i class="fas fa-credit-card"></i>
                            </a>
                        @else
                            <div class="alert alert-info text-center">
                                no books in cart
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script
        src="https://www.paypal.com/sdk/js?client-id=Afa3KKjgHWPCHAG9_K0moLY81nT5haD3zgRMx_9ECaU2bWd-axsMqVUDvF3VxxvjxuIPYtp1v-lwJK4x&currency=USD">
    </script>

    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return fetch('/api/paypal/create-payment', {
                    method: 'POST',
                    body: JSON.stringify({
                        'userId': "{{ auth()->user()->id }}",
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return fetch('/api/paypal/execute-payment', {
                    method: 'POST',
                    body: JSON.stringify({
                        orderId: data.orderID,
                        userId: "{{ auth()->user()->id }}",
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    $('#success').slideDown(200);
                    $('.card-body').slideUp(0);
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
