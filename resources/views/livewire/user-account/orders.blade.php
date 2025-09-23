<div class="my-account-content account-order">
    <div class="wrap-account-order">
        <table>
            <thead>
                <tr>
                    <th class="fw-6">#</th>
                    <th class="fw-6">@lang('Order')</th>
                    <th class="fw-6">@lang('Date')</th>
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
                            August 1, 2024
                        </td>
                        <td>
                            {{ $order->status->getTitleFa() }}
                        </td>
                        <td>
                            @lang(":amount for :number items", ['amount' => format_price($order->total), 'number' => $order->items_count])
                        </td>
                        <td>
                            <a href="my-account-orders.html#"
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