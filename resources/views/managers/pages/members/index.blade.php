@extends('managers.app.appHome')

@section('title')
Collaborateurs
@endsection

@section('css')

@endsection


@section('content')
<div class="content">
    <nav class="mb-2" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{route('collaborator_home')}}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="#!">Collaborateurs</a></li>
        <li class="breadcrumb-item active">Liste</li>
      </ol>
    </nav>
    <div class="mb-9">
      <div class="row g-2 mb-4">
        <div class="col-auto">
          <h2 class="mb-0">Mes collaborateurs</h2>
        </div>
      </div>
      <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Tous </span><span class="text-body-tertiary fw-semibold">({{$collaborator_count}})</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><span>Chef de projet </span><span class="text-body-tertiary fw-semibold">(1)</span></a></li>
        {{-- <li class="nav-item"><a class="nav-link" href="#"><span>Abandoned checkouts </span><span class="text-body-tertiary fw-semibold">(17)</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><span>Locals </span><span class="text-body-tertiary fw-semibold">(6,810)</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><span>Email subscribers </span><span class="text-body-tertiary fw-semibold">(8)</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><span>Top reviews </span><span class="text-body-tertiary fw-semibold">(2)</span></a></li> --}}
      </ul>
      <div id="products" data-list='{"valueNames":["customer","email","total-orders","total-spent","city","last-seen","last-order"],"page":10,"pagination":true}'>
        <div class="mb-4">
          <div class="row g-3">
            <div class="col-auto">
              <div class="search-box">
                <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" placeholder="Rechercher" aria-label="Rechercher" />
                  <span class="fas fa-search search-box-icon"></span>
                </form>
              </div>
            </div>
            <div class="col-auto scrollbar overflow-hidden-y flex-grow-1">
              <div class="btn-group position-static" role="group">
                <div class="btn-group position-static text-nowrap">
                    <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"> Role
                        <span class="fas fa-angle-down ms-2"></span>
                    </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Chefs de projet</a></li>
                    <li><a class="dropdown-item" href="#">Developpeurs</a></li>
                    <li><a class="dropdown-item" href="#">Commerciaux</a></li>
                  </ul>
                </div>
                <button class="btn btn-phoenix-secondary px-7 flex-shrink-0">Rechercher</button>
              </div>
            </div>
            <div class="col-auto">
                <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button><button class="btn btn-primary"><span class="fas fa-plus me-2">
            </div>
          </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
          <div class="table-responsive scrollbar-overlay mx-n1 px-1">
            <table class="table table-sm fs-9 mb-0">
              <thead>
                <tr>
                  <th class="sort align-middle pe-5" scope="col" data-sort="customer" style="width:10%;">NOM</th>
                  <th class="sort align-middle pe-5" scope="col" data-sort="email" style="width:20%;">EMAIL</th>
                  <th class="sort align-middle text-start" scope="col" data-sort="total-orders" style="width:10%">FONCTION</th>
                </tr>
              </thead>
              <tbody class="list" id="customers-table-body">
                @foreach ($collaborators as $collaborator)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                    <td class="customer align-middle white-space-nowrap pe-5"><a class="d-flex align-items-center text-body-emphasis" href="customer-details.html">
                        <div class="avatar avatar-m"><img class="rounded-circle avatar-placeholder" src="/managers/assets/img/team/avatar.webp" alt="" /></div>
                        <p class="mb-0 ms-3 text-body-emphasis fw-bold">{{$collaborator->name}}</p>
                      </a></td>
                    <td class="email align-middle white-space-nowrap pe-5"><a class="fw-semibold" href="mailto:{{$collaborator->email}}">{{$collaborator->email}}</a></td>
                    <td class="total-orders align-middle white-space-nowrap fw-semibold text-end text-body-highlight">{{$collaborator->fonction}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
            <div class="col-auto d-flex">
              <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
            <div class="col-auto d-flex"><button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
              <ul class="mb-0 pagination"></ul><button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('managers.partial.footer')
</div>
@endsection


@section('js')

@endsection
