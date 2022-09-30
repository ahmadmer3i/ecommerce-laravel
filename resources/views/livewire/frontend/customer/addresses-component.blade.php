<div x-data="{formShow: @entangle('showForm')}">
    <div class="d-flex">
        <h2 class="h5 text-uppercase mb-4">
            Addresses
        </h2>
        <div class="ml-auto">
            <button class="btn btn-primary rounded shadow" type="button" @click="formShow = true">
                Add new address
            </button>
        </div>
    </div>
    <form wire:submit.prevent="{{ $editMode ? 'update_address' : 'store_address' }}" x-show="formShow"
          @click.away="formShow=false">
        @if($editMode)
            <input type="hidden" wire:model="address_id" class="form-control">
        @endif
        <div class="row">
            <div class="col-lg-8 form-group">
                <label for="address_title" class="text-small text-uppercase">
                    Address title
                </label>
                <input type="text"
                       class="form-control"
                       id="address_title"
                       wire:model="address_title"
                       placeholder="Address Title"
                />
                @error('address_title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-4 form-group">
                <label class="text-small text-uppercase">
                    &nbsp;
                </label>
                <div class="form-check">
                    <input type="checkbox"
                           class="form-check-input"
                           id="default_address"
                           wire:model="default_address"
                           placeholder="Address Title"
                    />
                    <label for="default_address" class="form-check-label">Default Address?</label>
                </div>
            </div>
            <div class="col-lg-6 form-group">
                <label for="first_name" class="text-sm text-uppercase">
                    First name
                </label>
                <input type="text" class="form-control form-control-lg" wire:model="first_name"
                       placeholder="First name">
                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 form-group">
                <label for="last_name" class="text-sm text-uppercase">
                    First name
                </label>
                <input type="text" class="form-control form-control-lg" wire:model="last_name"
                       placeholder="First name">
                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 form-group">
                <label for="email" class="text-sm text-uppercase">
                    Email address
                </label>
                <input type="email" class="form-control form-control-lg" wire:model="email"
                       placeholder="Email address">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 form-group">
                <label for="mobile" class="text-sm text-uppercase">
                    Mobile number
                </label>
                <input type="text" class="form-control form-control-lg" wire:model="mobile"
                       placeholder="Mobile number">
                @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 form-group">
                <label for="address" class="text-sm text-uppercase">
                    Address
                </label>
                <input type="text" class="form-control form-control-lg" wire:model="address"
                       placeholder="Address">
                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 form-group">
                <label for="address2" class="text-sm text-uppercase">
                    Address 2
                </label>
                <input type="text" class="form-control form-control-lg" wire:model="address2"
                       placeholder="Address 2">
                @error('address2') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-4 form-group">
                <label for="country_id" class="text-sm text-uppercase">
                    Country
                </label>
                <select id="country_id" class="form-control form-control-lg" wire:model="country_id">
                    <option value="">Select Country</option>
                    @forelse($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-4 form-group">
                <label for="state_id" class="text-sm text-uppercase">
                    State
                </label>
                <select id="state_id" class="form-control form-control-lg" wire:model="state_id">
                    <option value="">Select State</option>
                    @forelse($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-4 form-group">
                <label for="city_id" class="text-sm text-uppercase">
                    City
                </label>
                <select id="city_id" class="form-control form-control-lg" wire:model="city_id">
                    <option value="">Select City</option>
                    @forelse($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 form-group">
                <label for="zip_code" class="text-sm text-uppercase">
                    ZIP Code
                </label>
                <input type="text" class="form-control form-control-lg" wire:model="zip_code"
                       placeholder="ZIP Code">
                @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 form-group">
                <label for="po_box" class="text-sm text-uppercase">
                    P.O Box
                </label>
                <input type="text" class="form-control form-control-lg" wire:model="po_box"
                       placeholder="P.O Box">
                @error('po_box') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-12 form-group">
                <button class="btn btn-dark" type="submit">
                    {{ $editMode ? 'Update Address' : 'Add Address'}}
                </button>
            </div>
        </div>
    </form>
    <div class="my-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Address title</th>
                    <th>Default</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($addresses as $address)
                    <tr>
                        <td>{{ $address->address_title }}</td>
                        <td>{{ $address->defaultAddress() }}</td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <button wire:click="edit_address('{{ $address->id }}')" class="btn btn-success"
                                        type="button">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button wire:click="delete_address('{{ $address->id }}')" class="btn btn-danger"
                                        type="button">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No Addresses Found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
