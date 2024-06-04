@extends('admins.app.app', ['title' => 'Mes produits'])

@section('title')
    Elèves
@endsection

@section('css')

@endsection


@section('content')
<div class="content">
        <nav class="mb-2" aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Gestion de messagérie</a></li>
            {{-- <li class="breadcrumb-item"><a href="#!">Elèves</a></li> --}}
            <li class="breadcrumb-item active">Discussions</li>
          </ol>
        </nav>
        <div class="mb-9">
          <div class="row g-3 mb-4">
            <div class="col-auto">
              <h2 class="mb-0">File de discussions</h2>
            </div>
          </div>
          <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Tous </span><span class="text-body-tertiary fw-semibold">(2)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span>Non lu </span><span class="text-body-tertiary fw-semibold">(5)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span>Non repondu </span><span class="text-body-tertiary fw-semibold">(2)</span></a></li>
            {{-- <li class="nav-item"><a class="nav-link" href="#"><span>En rupture de stock </span><span class="text-body-tertiary fw-semibold">(4)</span></a></li> --}}
          </ul>
          {{-- @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif

                            @if(session('infos'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('infos') }}
                            </div>
                        @endif --}}
          <div id="products" data-list='{"valueNames":["product","price","category","tags","vendor","time"],"page":10,"pagination":true}'>
            <div class="mb-4">
              <div class="d-flex flex-wrap gap-3">
                <div class="search-box">
                  <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" placeholder="Rechercher un produits" aria-label="Rechercher" />
                    <span class="fas fa-search search-box-icon"></span>
                  </form>
                </div>
                <div class="scrollbar overflow-hidden-y">
                  <div class="btn-group position-static" role="group">
                    <div class="btn-group position-static text-nowrap">
                        <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                            Classes
                            <span class="fas fa-angle-down ms-2"></span>
                        </button>
                      <ul class="dropdown-menu">
                        @foreach ($classes as $class)
                            <li><a class="dropdown-item" href="#">{{$class->name}}</a></li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="ms-xxl-auto">
                    <button class="btn btn-link text-body me-4 px-0">
                        <span class="fa-solid fa-file-export fs-9 me-2"></span>
                        Exporter
                    </button>
                    <a href="#projectsBoardViewModalB" data-bs-toggle="modal">
                        <button class="btn btn-primary" id="addBtn">
                            <span class="fas fa-plus me-2"></span>
                            Ajouter un élève
                        </button>
                    </a>
                </div>
              </div>
            </div>
            <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
              <div class="table-responsive scrollbar mx-n1 px-1">
                <table class="table fs-9 mb-0">
                  <thead>
                    <tr>
                      {{-- <th class="white-space-nowrap fs-9 align-middle ps-0" style="max-width:20px; width:18px;">
                        <div class="form-check mb-0 fs-8"><input class="form-check-input" id="checkbox-bulk-products-select" type="checkbox" data-bulk-select='{"body":"products-table-body"}' /></div>
                      </th> --}}
                      <th class="sort white-space-nowrap align-middle fs-10" scope="col">##</th>
                      <th class="sort white-space-nowrap align-middle ps-4" scope="col" data-sort="product">EXPEDITEUR</th>
                      <th class="sort align-middle text-start ps-4" scope="col" data-sort="price">OBJET</th>
                      <th class="sort align-middle text-start ps-4" scope="col" data-sort="price">DATE</th>
                      <th class="sort align-middle ps-4" scope="col" data-sort="category">STATUS</th>
                      <th class="sort text-start align-middle pe-0 ps-4" scope="col"></th>
                    </tr>
                  </thead>
                  <tbody class="list" id="products-table-body">
                    @foreach ($messages as $message)
                    <tr class="position-static">
                        {{-- <td class="fs-9 align-middle">
                          <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Fitbit Sense Advanced Smartwatch with Tools for Heart Health, Stress Management & Skin Temperature Trends, Carbon/Graphite, One Size (S & L Bands...","productImage":"/products/1.png","price":"$39","category":"Plants","tags":["Health","Exercise","Discipline","Lifestyle","Fitness"],"star":false,"vendor":"Blue Olive Plant sellers. Inc","publishedOn":"Nov 12, 10:45 PM"}' /></div>
                        </td> --}}
                        <td class="align-middle white-space-nowrap py-0">
                            <a class="d-block border border-translucent rounded-2" target="_blank" href="{{$message ->photo}}">
                                <img src="/storage/{{$message ->photo}}" alt="" width="53"/>
                            </a>
                        </td>
                        <td class="product align-middle ps-4"><a class="fw-semibold line-clamp-3 mb-0" href="#">{{$message->first_name}} {{$message->last_name}}</a></td>
                        <td class="price align-middle white-space-nowrap text-start fw-bold text-body-tertiary ps-4">{{$message -> subject}}</td>
                        
                        <td class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">{{ \Carbon\Carbon::parse($message->date)->format('M j, Y') }}. {{ \Carbon\Carbon::parse($message->date)->format('H:i') }}</td>
                        <td class="tags align-middle review pb-2 ps-3">
                            <a class="text-decoration-none" href="#!">
                                @if ($message->statut == -1)
                                    <span class="badge badge-tag me-2 mb-2">Non lu</span>
                                @elseif($message->statut == 0)
                                    <span class="badge badge-tag me-2 mb-2">Non repondu</span>
                                @else
                                    <span class="badge badge-tag me-2 mb-2">Repondu</span>
                                @endif
                            </a>
                        </td>
                        {{-- <td class="time align-middle white-space-nowrap text-body-tertiary text-opacity-85 ps-4">{{ \Carbon\Carbon::parse($message->created_at)->format('M j, Y') }}. {{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}</td> --}}
                        <td class="align-middle white-space-nowrap text-start pe-0 ps-4 btn-reveal-trigger">
                          <div class="btn-reveal-trigger position-static">
                            <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2">
                              <a class="dropdown-item" href="#">Modifier les informations</a>
                              <a class="dropdown-item" href="#InboxParent" data-bs-toggle="modal" data-product-id="{{$message->id}}">Contacter les parents</a>
                              <a class="dropdown-item" href="#">Assigner des notes</a>
                              {{-- <a class="dropdown-item" href="#projectsBoardViewModalB" data-bs-toggle="modal">Faire une promotion</a> --}}
                              {{-- @if ($message->en_promotion == 0)
                                <a class="dropdown-item" href="#projectsBoardViewModalB" data-bs-toggle="modal" data-product-id="{{$message->id}}">Faire une promotion</a>
                              @else
                                <a class="dropdown-item" href="#projectsBoardViewModalB" data-bs-toggle="modal" data-product-id="{{$message->id}}">Editer la promotion</a>
                                <a class="dropdown-item" href="{{route('admin_reset_promotion', ['product_id' => $message->id])}}">Annuler la promotion</a>
                              @endif
                              @if ($message->status ==0)
                                <a class="dropdown-item" href="#" onclick="confirmPublish('{{ route('admin_product_publish', ['code' => $message->code]) }}')">Publier sur la plateforme</a>
                              @endif
                              <div class="dropdown-divider"></div>
                                @if ($message->status==1)
                                    <a class="dropdown-item text-danger" href="#!" onclick="confirmNotPublish('{{ route('admin_product_no_publish', ['code' => $message->code, 'id_user' => Auth::guard('admin')->user()->id]) }}')">Annuler la publication</a>
                                @endif --}}
                                {{-- onclick="confirmDelete('{{ route('admin_product_delete', ['code' => $message->code])}}')" --}}
                              <a class="dropdown-item text-danger" href="#!" onclick="confirmDelete('{{ route('admin_students_delete', ['token' => $message->token])}}')">Supprimer</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                  <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                  <a class="fw-semibold" href="#!" data-list-view="*">Voir plus
                    <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                  </a>
                  <a class="fw-semibold d-none" href="#!" data-list-view="less">Voir moins
                    <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                  </a>
                </div>
                <div class="col-auto d-flex">
                    <button class="page-link" data-list-pagination="prev">
                        <span class="fas fa-chevron-left"></span>
                    </button>
                  <ul class="mb-0 pagination"></ul>
                  <button class="page-link pe-0" data-list-pagination="next">
                    <span class="fas fa-chevron-right"></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- <div class="modal fade" id="projectsBoardViewModalB" tabindex="-1" aria-labelledby="projectsBoardViewModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content overflow-hidden">
                <div class="modal-header position-relative p-0">
                    <button class="btn btn-circle project-modal-btn position-absolute end-0 top-0 mt-3 me-3 bg-body-emphasis" data-bs-dismiss="modal">
                        <span class="fa-solid fa-xmark text-body dark__text-white"></span>
                    </button>
                </div>
                <form class="mb-3" method="post" action="#">
                    @csrf
                    <div class="col-12 col-xl-9" style="display: none">
                        <input class="form-control" name="product_id" type="text" placeholder="ID produit *"/>
                    </div>

                    <div class="col-12 col-xl-9" style="display: none">
                        <input class="form-control" name="id_user" type="text" value="{{Auth::guard('admin')->user()->id}}" />
                    </div>

                    <div class="row g-5" style="padding-left: 40px; padding-bottom: 20px; padding-right: 40px; padding-top: 40px;">
                        <div class="col-12 col-xl-12">
                            <h4 class="mb-3">Date de debut</h4>
                            <input class="form-control" name="date_debut" type="datetime-local" placeholder="Choisir une date *" required/>
                        </div>
                    </div>
                    <div class="row g-5" style="padding-bottom: 20px; padding-left: 40px; padding-right: 40px">
                        <div class="col-12 col-xl-12">
                            <h4 class="mb-3">Date de fin</h4>
                            <input class="form-control" name="date_fin" type="datetime-local" placeholder="Choisir une date *" required/>
                        </div>
                    </div>
                    <div class="row g-5" style="padding-bottom: 20px; padding-left: 40px; padding-right: 40px">
                        <div class="col-12 col-xl-12">
                            <h4 class="mb-3">Pourcentage</h4>
                            <input class="form-control" name="pourcentage" type="number" step="0.1" placeholder="Pourcentage à appliquer *" required/>
                        </div>
                    </div>
                    <div class="col-auto mb-3" style="padding-bottom: 40px; padding-left: 40px; padding-right: 40px;">
                        <button class="btn btn-phoenix-primary me-2 mb-2 mb-sm-0" type="reset">Effacer</button>
                        <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Enregistrer</button>
                    </div>
                </form>
              </div>
            </div>
        </div> --}}
        @include('admins.pages.students.add')
        @include('admins.pages.messages.inbox')


        @include('admins.partial.footer')
    </div>
@endsection


@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Récupérer le modal et le champ eleve_id
      const modal = document.getElementById('InboxParent');
      const productIdInput = modal.querySelector('input[name="eleve_id"]');

      // Écouter le clic sur les boutons "Faire une promotion"
      const promotionButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
      promotionButtons.forEach(button => {
        button.addEventListener('click', function() {
          const productId = this.getAttribute('data-product-id');
          // Affecter l'ID du produit au champ product_id dans le formulaire
          productIdInput.value = productId;
        });
      });
    });
</script>




{{-- Script pour afficher un popup de confirmation lorsque l'utilisateur souhaite supprimer un produit. --}}
<script>
    function confirmDelete(deleteUrl) {
        // Afficher la popup de confirmation
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir supprimer cet élève ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler',
        }).then((result) => {
            // Si l'utilisateur clique sur "Oui, supprimer" dans la popup, effectuer la suppression
            if (result.isConfirmed) {
                // Rediriger vers l'URL de suppression passée en paramètre
                window.location.href = deleteUrl;
            }
            // Sinon, ne rien faire
        });
    }
</script>


<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: "220px",
            placeholder: "Votre message * *"
        })
    })
</script>


{{-- Script d'affichage de popup de confirmation lorsque l'utilisateur souhaite publier un produit --}}
<script>
    function confirmPublish(deleteUrl) {
        Swal.fire({
            title: 'Le produit sera visible sur la plateforme lavendeuse.africa.',
            // text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, publier',
            cancelButtonText: 'Annuler',
        }).then((result) => {
            // Si l'utilisateur clique sur "Oui, publier" dans la popup, effectuer la publication
            if (result.isConfirmed) {
                // Rediriger vers l'URL de publication passée en paramètre
                window.location.href = deleteUrl;
            }
            // Sinon, ne rien faire
        });
    }
</script>

{{-- Script d'affichage de popup de confirmation lorsque l'utilisateur souhaite annuler la publication du produit --}}
<script>
    function confirmNotPublish(deleteUrl) {
        Swal.fire({
            title: 'Le produit ne sera plus visible sur la plateforme lavendeuse.africa.',
            // text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, depublier',
            cancelButtonText: 'Annuler',
        }).then((result) => {
            // Si l'utilisateur clique sur "Oui, annuler" dans la popup, effectuer l'annulation
            if (result.isConfirmed) {
                // Rediriger vers l'URL d'annulation passée en paramètre
                window.location.href = deleteUrl;
            }
            // Sinon, ne rien faire
        });
    }
</script>

{{-- Popup d'affichage d'eventuel erreurs survenues lors d'une opération. --}}
<script>
    @if(session('error'))
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Erreur',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
    @endif
</script>

{{-- Popup affichant une opération réussie --}}

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Succès',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            showConfirmButton: false,
        });

        // setTimeout(function() {
        //     window.location.href = '{{ route('admin_students_list') }}';
        // }, 1000);
    });
</script>
@endif
@endsection
