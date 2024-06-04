<div class="modal fade" id="projectsBoardViewModalB" tabindex="-1" aria-labelledby="projectsBoardViewModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content overflow-hidden">
        <div class="modal-header position-relative p-0">
            <button class="btn btn-circle project-modal-btn position-absolute end-0 top-0 mt-3 me-3 bg-body-emphasis" data-bs-dismiss="modal">
                <span class="fa-solid fa-xmark text-body dark__text-white"></span>
            </button>
        </div>
          <div class="row mt-8" style="margin: 20px">
            <form method="post" action="#" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-7 mb-4 mb-lg-0">
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
                        <h3 class="mb-5">Remplissez ce formulaire !</h3>
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Nom de l'élève</label>
                                <input class="form-control" id="inputAddress1" name="first_name" type="text" placeholder="Nom *" />
                            </div>
                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Prenom de l'élève</label>
                                <input class="form-control" id="inputAddress2" name="last_name" type="text" placeholder="Prenom *" />
                            </div>
    
                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Date de naissance</label>
                                <input class="form-control" id="inputAddress2" name="date_naissance" type="datetime-local" placeholder="Date de naissance *" />
                            </div>
    
                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Lieu de naissance</label>
                                <input class="form-control" id="inputAddress2" name="lieu_naissance" type="text" placeholder="Lieu *" />
                            </div>
    
                            <div class="col-12">
                                <label for="duree_de_garantie"><h5 class="text-body-highlight me-2">Classe</h5></label>
                                <div class="input-group">
                                    <select class="form-select" id="inputCity">
                                        @foreach ($classes as $class)
                                            <option value="+{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input name="telephone" class="form-control" id="number" type="tel" placeholder="Numéro *" /> --}}
                                </div>
                            </div>
    
                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Photo 4*4</label>
                                <input class="form-control" id="inputAddress2" name="photo" type="file" placeholder="Profil *" />
                            </div>
    
                            <div class="col-12">
                                <button class="btn btn-primary mb-2 px-8 px-sm-11 me-2" type="submit" >Se connecter</button>
                                <a href="#"><button class="btn btn-phoenix-secondary text-nowrap" type="button">Je n'ai pas un compte</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4 offset-xl-1">
                        <div class="card mt-70 mt-lg-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                <h3 class="mb-0">Info parents</h3>
                                </div>
                                <div class="border-dashed border-bottom border-translucent mt-4">
                                    <div class="ms-n2">
                                        <div class="row align-items-center mb-2 g-3">
                                            <div class="col-12">
                                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Nom du père</label>
                                                <input class="form-control" id="inputAddress2" name="photo" type="text" placeholder="Profil *" />
                                            </div>
    
                                            <div class="col-12">
                                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Prenom du père</label>
                                                <input class="form-control" id="inputAddress2" name="photo" type="text" placeholder="Profil *" />
                                            </div>
    
                                            <div class="col-12">
                                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Nom de la mère</label>
                                                <input class="form-control" id="inputAddress2" name="photo" type="text" placeholder="Profil *" />
                                            </div>
    
                                            <div class="col-12">
                                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Nom de la mère</label>
                                                <input class="form-control" id="inputAddress2" name="photo" type="text" placeholder="Profil *" />
                                            </div>
    
                                            <div class="col-12">
                                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Nom du tuteur</label>
                                                <input class="form-control" id="inputAddress2" name="photo" type="text" placeholder="Profil *" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
