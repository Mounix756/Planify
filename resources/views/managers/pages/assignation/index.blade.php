@extends('managers.app.app', ['title' => 'Assignation des taches'])

@section('title')
    Assignations
@endsection

@section('css')

@endsection


@section('content')
<div class="content">
    <nav class="mb-2" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#!">Page 1</a></li>
        <li class="breadcrumb-item"><a href="#!">Page 2</a></li>
        <li class="breadcrumb-item active">Default</li>
      </ol>
    </nav>
    <h2 class="mb-4">Assignée une tache aux collaborateurs</h2>
    <div class="row">
      <div class="col-xl-9">
        <form class="row g-3 mb-6" method="POST" action="{{route('assign_add')}}" enctype="multipart/form-data">
          @csrf
             @if(session('success'))
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
          @endif
          <div class=" col-md-10 ">
            <div class="form-floating" style="display: none">
              <input class="form-control" name="name" id="floatingInputGrid" type="text" value="{{Auth::guard('manager')->user()->id}}" />
              <label for="floatingInputGrid">Nom de la tache</label>
            </div>
          </div>
          <div class="col-8 col-sm-4"><select class="form-select form-select-sm" id="select-gross-revenue-month">
            <option>Choisir les collaborateurs</option>
            <option value="{{$user->id}}">{{$user->name}}</option>
          </select></div>
          
          <div class="col-12 gy-6">
            <div class="row g-3 justify-content-center">
              <div class="col-auto"><button class="btn btn-phoenix-primary px-5">Supprimer</button></div>
              <div class="col-auto"><button type="submit" class="btn btn-primary px-5 px-sm-15">Assigner la tache</button></div>
            </div>
          </div>
        </form>
      </div>
    </div>
   
  </div>
  @endsection


@section('js')

<script>
  document.addEventListener('DOMContentLoaded', function () {
      var element = document.getElementById('organizerMultiple');
      var choices = new Choices(element, {
          removeItemButton: true,
          placeholder: true
      });
  });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Récupérer le modal et le champ eleve_id
      const modal = document.getElementById('AjoutProjet');
      const productIdInput = modal.querySelector('input[name="id"]');

      // Écouter le clic sur les boutons "Faire une promotion"
      const promotionButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
      promotionButtons.forEach(button => {
        button.addEventListener('click', function() {
          const productId = this.getAttribute('data-product-id');
          // Affecter l'ID du produit au champ product_id dans le formulaire
          productIdInput.value = id;
        });
      });
    });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Récupérer le modal et le champ eleve_id
    const modal = document.getElementById('EditProjet');
    const productIdInput = modal.querySelector('input[name="project_id"]');

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



<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: "220px",
            placeholder: "Votre message * *"
        })
    })
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
