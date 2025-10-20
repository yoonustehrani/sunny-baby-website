<div class="my-account-content account-order">
    <div class="wrap-account-order">
        <table>
            <thead>
                <tr>
                    <th class="fw-6">ردیف</th>
                    <th class="fw-6">@lang('ID')</th>
                    <th class="fw-6">@lang('Creation Date')</th>
                    <th class="fw-6">@lang('Status')</th>
                    <th class="fw-6">@lang('Total')</th>
                    <th class="fw-6"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="tf-order-item">
                        <th>{{ $loop->index + 1 }}</th>
                        <td>
                            {{ $order->id }}
                        </td>
                        <td>
                            {{ jalali($order->created_at) }}
                            <br>
                            {{ $order->created_at->format('H:i') }}
                        </td>
                        <td>
                            {{ $order->status->getTitleFa() }}
                        </td>
                        <td>
                            @lang(":amount for :number items", ['amount' => format_price($order->total), 'number' => $order->items_count])
                        </td>
                        <td>
                            @if ($order->status == \App\Enums\OrderStatus::PENDING)
                                <a href="{{ route('orders.pay', ['order' => $order->getKey(), 'gateway' => 'zp']) }}" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                    <span>پرداخت</span>
                                </a>
                                <br>
                                <br>
                            @endif
                            <a href="#view"
                                class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                <span>@lang('View')</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>