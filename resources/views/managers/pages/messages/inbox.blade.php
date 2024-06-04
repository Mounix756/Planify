<div class="modal fade" id="InboxParent" tabindex="-1" aria-labelledby="projectsBoardViewModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content overflow-hidden">
        <div class="modal-header position-relative p-0">
            <button class="btn btn-circle project-modal-btn position-absolute end-0 top-0 mt-3 me-3 bg-body-emphasis" data-bs-dismiss="modal">
                <span class="fa-solid fa-xmark text-body dark__text-white"></span>
            </button>
        </div>
          <div class="row mt-8" style="margin: 20px">
            <form method="post" action="{{route('admin_send_message_to_parent')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12 mb-4 mb-lg-0">
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
                        <h3 class="mb-5">Inbox !</h3>
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Object</label>
                                <input class="form-control" id="inputAddress1" name="subject" type="text" placeholder="Oject *" />
                            </div>

                            <div class="col-12" style="display: none">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">ID</label>
                                <input class="form-control" id="inputAddress1" name="eleve_id" type="text" placeholder="Oject *" />
                            </div>

                            <div class="col-12" style="display: none">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Prenom de l'élève</label>
                                <input class="form-control" name="sender_id" type="text" value="{{Auth::guard('admin')->user()->id}}"/>
                            </div>


                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Message</label>
                                <textarea id="content" class="form-control" name="content" type="text" placeholder="Votre message *"></textarea>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-primary mb-2 px-8 px-sm-11 me-2" type="submit" >Enregistrer</button>
                                <a href="#"><button class="btn btn-phoenix-secondary text-nowrap" type="button">Effacer</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
