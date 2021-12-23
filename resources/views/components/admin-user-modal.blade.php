<div class="modal fade" id="u{{$user->id}}" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update: {{$user->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="user-block mt-5">
                    <div class="user-information">
                        <div class="user-info">
                            <div class="input-group">
                                <input type="hidden" class="user-id" data-id="{{$user->id}}">
                                <span class="input-group-text">Name</span>
                                <input type="text" aria-label="name" class="form-control name" data-name="{{$user->id}}" value="{{$user->name}}" placeholder="{{$user->name}}">
                            </div>
                        </div>
                        <div class="user-info mt-2">
                            <div class="input-group">
                                <span class="input-group-text">Email</span>
                                <input type="text" aria-label="email" class="form-control email" data-email="{{$user->id}}" value="{{$user->email}}" placeholder="{{$user->email}}">
                            </div>
                        </div>
                        <div class="user-info mt-2">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Role</label>
                                <select class="form-select" id="inputGroupSelect01" data-select="{{$user->id}}">
                                        @foreach($user->roles as $role)
                                            <option selected value="{{$role->id}}">{{$role->title}}</option>
                                            {{$role->title}}
                                        @endforeach
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->title}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                </main>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary save-changes" data-save-button="{{$user->id}}">Save changes</button>
            </div>
        </div>
    </div>
</div>
