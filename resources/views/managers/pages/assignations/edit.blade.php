<div class="modal fade" id="editAssignBtn" tabindex="-1" aria-labelledby="projectsBoardViewModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content overflow-hidden">
        <div class="modal-header position-relative p-0">
            <button class="btn btn-circle project-modal-btn position-absolute end-0 top-0 mt-3 me-3 bg-body-emphasis" data-bs-dismiss="modal">
                <span class="fa-solid fa-xmark text-body dark__text-white"></span>
            </button>
        </div>
          <div class="row mt-8" style="margin: 20px">
        <form class="row g-3 mb-6" method="POST" action="{{ route('update_assign', ['id' => $assignment->id]) }}" enctype="multipart/form-data">
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
              <label for="floatingInputGrid"></label>
            </div>
          </div>

          <div class="d-flex justify-content-center align-items-center" style="height: 250px;">
            <div>
                <img src="{{ asset('logo/logo.png') }}" alt="Mounix School" height="300" width="700" />
            </div>
        </div>

          <div class="col-md-12">

            <div class="row">
             
              <div class="col-md-6">
                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="task_id">Choisir la tâche</label>
                <select class="form-select form-select-sm" id="task_id" >
                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="col-md-6">
                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="collaborator_id">Choisir le collaborateur</label>
                <select class="form-select form-select-sm" id="collaborator_id" >
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            </div>
          </div>
          
          <div class="col-12 gy-6">
            <div class="row g-3 justify-content-center">
              <div class="col-auto"><button class="btn btn-phoenix-primary px-5">Supprimer</button></div>
              <div class="col-auto"><button type="submit" class="btn btn-primary px-5 ">Assigner la tache</button></div>
            </div>
          </div>
        </form>
    </form>
</div>
</div>
</div>