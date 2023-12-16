
<div class="card">
    <div class="card-body">
        <div class="row mb-1">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2">
                <label class="form-label" style="font-size: 15px" for="roles">Roles</label>
                <select class="select2-size-lg form-select" id="roles" name="parent_id">
                    @foreach ($roles as $roleRow)
                        @continue(isset($role) && $roleRow->id == $role->id)
                        <option data-icon="fa-solid fa-angle-right"
                            value="{{ $roleRow['id'] }}"{{ (isset($role) ? $role->parent_id : old('type')) == $roleRow['id'] ? 'selected' : '' }}>
                            {{ $roleRow['tree'] }}</option>
                    @endforeach
                </select>
                @error('parent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter parent role.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="name">Role Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Role Name" value="{{ isset($role) ? $role->name : null }}" />
                @error('name')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label d-none" style="font-size: 15px" for="guard_name">Guard Name</label>
                <input type="hidden" class="form-control" id="guard_name" name="guard_name" placeholder="web"
                    value="{{ isset($role) ? $role->guard_name : 'web' }}" />
                @error('guard_name')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
