@extends('frontend.layouts.dashboard')
@section('title', 'Customer Login & Registration')

@section('content')




                    <div class="col-lg-9">
                        <table class="table aiz-table mb-0">
                            <thead>
                            <tr>
                                <th>{{ translate('Order Code') }}</th>
                                <th data-breakpoints="md">{{ translate('Num. of Products') }}</th>
                                <th data-breakpoints="md">{{ translate('Amount') }}</th>
                                <th data-breakpoints="md">{{ translate('Payment Status') }}</th>
                                <th class="text-right" width="15%">{{ translate('options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <!--                    <td>
                                        {{ $key + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}
                                    </td>-->
                                    <td>
                                        {{ $order->code }}
                                    </td>
                                    <td>
                                        {{ count($order->orderDetails) }}
                                    </td>
                                    <td>
                                        {{ single_price($order->grand_total) }}
                                    </td>

                                    <td>
                                        @if ($order->payment_status == 'paid')
                                            <span class="badge badge-inline bg-success">{{ translate('Paid') }}</span>
                                        @else
                                            <span class="badge badge-inline bg-danger">{{ translate('Unpaid') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                           href="{{ url('/all_orders/'.encrypt($order->id).'/show')  }}"
                                           title="{{ translate('View') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $orders->appends(request()->input())->links() }}
                        </div>
                </div>


@endsection

@section('style')
<!-- Add any custom styles if needed -->
@endsection

@section('script')

@endsection
