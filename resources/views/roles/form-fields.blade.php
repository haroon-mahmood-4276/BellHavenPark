@php
    $dir = getIconDirection(LaravelLocalization::getCurrentLocaleDirection());
@endphp
<div class="card">
    <div class="card-body">
        <div class="row mb-1">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2">
                <label class="form-label" style="font-size: 15px" for="roles">Roles</label>
                <select class="select2-size-lg form-select" id="roles" name="parent_id">
                    <option data-icon="fa-solid fa-angle-{{ $dir }}" value="0" selected>Parent Role
                    </option>
                    @foreach ($roles as $roleRow)
                        @continue(isset($role) && $roleRow->id == $role->id)
                        <option data-icon="fa-solid fa-angle-{{ $dir }}"
                            value="{{ $roleRow['id'] }}"{{ (isset($role) ? $role->parent_id : old('type')) == $roleRow['id'] ? 'selected' : '' }}>
                            {{ $roleRow['tree'] }}</option>
                    @endforeach
                </select>
                @error('parent_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="role_name">Role Name</label>
                <input type="text" class="form-control @error('role_name') is-invalid @enderror" id="role_name"
                    name="role_name" placeholder="Role Name" value="{{ isset($role) ? $role->name : null }}" />
                @error('role_name')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="guard_name">Guard Name</label>
                <input type="text" class="form-control" id="guard_name" name="guard_name" placeholder="web"
                    value="{{ isset($role) ? $role->guard_name : 'admin' }}" />
                @error('guard_name')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
