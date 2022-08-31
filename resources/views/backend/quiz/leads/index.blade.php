@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('All User Results') }}</h5>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th data-breakpoints="sm">#</th>
                        <th>{{ translate('Email') }}</th>
                        <th data-breakpoints="sm">{{ translate('Date') }}</th>
                        <th data-breakpoints="sm">{{ translate('Checked') }}</th>
                        <th data-breakpoints="lg">Description</th>
                        <th data-breakpoints="lg">Gardens</th>
                        <th data-breakpoints="lg">Plants</th>
                        <th data-breakpoints="sm" class="text-right">{{ translate('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $key => $lead)
                        <tr>
                            <td>{{ $key + 1 + ($leads->currentPage() - 1) * $leads->perPage() }}</td>
                            <td>
                                <div class="text-truncate">{{ $lead->email }}</div>
                            </td>
                            <td>{{ date('d-m-Y', strtotime($lead->created_at)) }}</td>
                            <td>
                                @if ($lead->orders_id)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                            @php
                                $gardens_ids = [$lead->type1, $lead->type2, $lead->type3];
                                $garden1_plants = json_decode($lead->type1_plants, true);
                                $garden2_plants = json_decode($lead->type2_plants, true);
                                $garden3_plants = json_decode($lead->type3_plants, true);

                                $first_merge = array_merge($garden1_plants, $garden2_plants);
                                $all_plant_ids = array_merge($first_merge, $garden3_plants);
                                $results = \App\Result::findOrFail($lead->results_id);
                                $gardens = \App\Garden::whereIn('id', $gardens_ids)->get();
                                $plants = \App\Plant::whereIn('id', $all_plant_ids)->get();
                            @endphp
                            <td>
                                {{ $results->description }}
                            </td>
                            <td>
                                <div class="row">
                                    @foreach ($gardens as $garden)
                                        <div class="col-md-4 mb-2">
                                            <div class="w-100px bg-no-repeat bg-cover bg-center lazyload"
                                                style="background-image: url('{{ uploaded_asset($garden->logo) }}');"
                                                data-bg="{{ static_asset('assets/img/qr1.jpg') }}">
                                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    class="img-fluid lazyload invisible"
                                                    data-src="{{ static_asset('assets/img/qr1.jpg') }}">
                                            </div>
                                            <div class="body">
                                                <div class="fs-12 ff-bold">{{ $garden->name }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    @foreach ($plants as $plant)
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                                            <div class=" position-relative">
                                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($plant->logo) }}"
                                                    class="img-fluid lazyload">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-right">
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                    data-href="{{ route('lead.destroy', $lead->id) }}"
                                    title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $leads->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
