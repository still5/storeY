@extends('layouts.app-new')

@section('content')
    <div class="page-content-container-wide">
        <form enctype="multipart/form-data" action="{{ route('orders.index') }}" method="get" id="status-dropdown">
            <label for="status">Filter by status:</label>
            <select id="status" name="status">
                <option value="all" {{ $data["status"] == "all" ? "selected" : "" }} >All</option>
                @foreach(App\Enums\OrderStatusEnum::values() as $key=>$value)
                    <option value="{{ $key }}" {{ $data['status'] == "$key" ? "selected" : "" }} >{{ $value }}</option>
                @endforeach
            </select>
        </form>
        <table>
            <th>ID</th>
            <th>Product</th>
            <th>Price,₴</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Action</th>
        @foreach ($data['orders'] as $order)
            <tr>
                        <td class="card-title">{{ $order->id }}</td>
                        <td class="card-title">{{ $order->product_name }}</td>
                        <td class="card-text">{{ $order->price }}</td>
                        <td class="card-text">{{ $order->user_name }}</td>
                        <td class="card-text">{{ $order->status }}</td>
                        <td class="card-text">
                            <a href="/order/edit/{{ $order->id }}" class="btn btn-primary">
                                <button class="open-product-btn">
                                    Edit
                                </button>
                            </a>
                        </td>
            </tr>
        @endforeach
        </table>
        <div class="pagination justify-content-center">
            {{ $data['orders']->links() }}
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function dataFilter(id){
        $(id).on('change', function(e){
            let variable = e.target.value;
            $(id + '-dropdown').submit();
        });
    };
    dataFilter('#status');
</script>
@endsection
