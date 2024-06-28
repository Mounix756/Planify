<div class="modal fade" id="addAssignBtn" tabindex="-1" aria-labelledby="projectsBoardViewModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content overflow-hidden">
            <div class="modal-header position-relative p-0">
                <button class="btn btn-circle project-modal-btn position-absolute end-0 top-0 mt-3 me-3 bg-body-emphasis" data-bs-dismiss="modal">
                    <span class="fa-solid fa-xmark text-body dark__text-white"></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('manager_add_new_assign') }}" enctype="multipart/form-data">
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

                    <div class="row g-3">
                        <div class="col-md-6" style="display: none">
                            <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="user_id">ID Utilisateur</label>
                            <input class="form-control" id="user_id" name="user_id" type="text" value="{{ Auth::guard('manager')->user()->id }}" placeholder="ID Utilisateur *"  />
                        </div>
                        <div class="d-flex mt-4 justify-content-center align-items-center" style="height: 200px;">
                            <div>
                                <img src="{{ asset('logo/logo.png') }}" alt="Mounix School" height="300" width="700" />
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="task_id">Choisir les tâches</label>
                            <select class="form-select form-select-sm" id="task_id" name="task_id[]" multiple>
                                @foreach ($tasks as $task)
                                    <option value="{{ $task->id }}">{{ $task->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="col-md-6">
                            <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="collaborator_id">Choisir les collaborateurs</label>
                            <select class="form-select form-select-sm" id="collaborator_id" name="collaborator_id[]" multiple>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    </div>

                    <div class="row g-3 justify-content-center mb-5 mt-3">
                        <div class="col-auto"><button class="btn btn-phoenix-primary px-5">Supprimer</button></div>
                        <div class="col-auto"><button type="submit" class="btn btn-primary px-5">Assigner la tâche</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
