<p>Пользователь <b>{{$orders[0]->user->name}} ({{$orders[0]->user->email}})</b> оформил заказ:</p>
<table>
    <thead>
    <tr>
        <th>Номер</th>
        <th>Товар</th>
        <th>Цена</th>
        <th>Дата</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td><a href="{{route('product', ['product_id' => $order->product->id])}}">{{$order->product->name}}</a></td>
            <td>{{$order->product->price}}</td>
            <td>{{$order->updated_at->format('d.m.Y')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

