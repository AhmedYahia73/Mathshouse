
@php
    $page_name = 'Profile';
@endphp
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')
@section('title','Profile')

@section('page_content')
<div class="card mb-4 col-xl-9 col-lg-9 col-md-12">
      
    <h5 class="card-header">Profile : {{  auth()->user()->name }}</h5>
    <!-- Account -->
    @include('success')
      <form id="formAccountSettings" action="{{ route('stu_edit_profile') }}" method="POST" enctype="multipart/form-data" >
          @csrf
          <input type="hidden" name="id" value = {{ auth()->user()->id }}>
      <div class="card shadow-sm rounded-3">
  <div class="card-body">
    <div class="d-flex flex-column flex-md-row align-items-center gap-4">
      
      <!-- User Avatar -->
      <div class="text-center">
        <img
            src="{{asset('images/users/' . auth()->user()->image) }}" alt="user-avatar"
            class="d-block rounded"
            height="100"
            width="100"
            id="uploadedAvatar" />
      </div>

      <!-- User Info + Upload -->
      <div class="flex-grow-1 w-100">
        <!-- Upload button -->
        <label for="upload" class="btn btn-primary mb-3">
          <i class="bx bx-upload me-1"></i> Upload new photo
          <input
            type="file"
            id="upload"
            name="image"
            class="account-file-input d-none"
          />
        </label>

        <!-- User details -->
        <div class="row">
          <div class="col-md-6 mb-2">
            <strong>Country:</strong> 
            <span>{{ auth()->user()?->city?->country?->name ?? '-' }}</span>
          </div>
          <div class="col-md-6 mb-2">
            <strong>City:</strong> 
            <span>{{ auth()->user()?->city?->city ?? '-' }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <hr class="my-0" />
    <div class="card-body">
        <div class="row">
          <div class="mb-3 col-md-6">
            <label for="firstName" class="form-label">First Name</label>
            <input
              class="form-control"
              type="text"
              id="firstName"
              value="{{ auth()->user()->f_name }}"
              placeholder="{{ auth()->user()->f_name }}"
              name="f_name"
            />
          </div>
          
          <div class="mb-3 col-md-6">
            <label for="firstName" class="form-label">Last Name</label>
            <input
              class="form-control"
              type="text"
              id="firstName"
              value="{{ auth()->user()->l_name }}"
              placeholder="{{ auth()->user()->l_name }}"
              name="l_name"
            />
          </div>

          <div class="mb-3 col-md-6">
            <label for="nick_name" class="form-label">Nick Name</label>
            <input
              class="form-control"
              type="text"
              id="nick_name"
              value="{{ auth()->user()->nick_name }}"
              placeholder="Nick Name"
              name="nick_name"
            />
          </div>
         
          <div class="mb-3 col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input
              class="form-control"
              type="text"
              id="email"
              value="{{ auth()->user()->email }}"
              name="email" />
          </div>
          
          <div class="mb-3 col-md-6">
            <label class="form-label" for="phoneNumber">Phone</label>
            <div class="input-group input-group-merge">
     
              <input
                type="text"
                id="phoneNumber"
                class="form-control"
                value="{{ auth()->user()->phone }}"
                name="phone" />
            </div>
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label" for="Password">password</label>
            <div class="input-group input-group-merge">
           
              <input
                type="password"
                id="Password"
                name="password"
                autocomplete="new-password"
                class="form-control"
                placeholder="Enter Your New Password" />
            </div>
          </div>
         
              <input
                type="hidden"
                id="OldPassword"
                name="old_password" 
                value="{{auth()->user()->password}}"
                class="form-control"
                placeholder="Enter Your Old Password"
                 />
             
      
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Category</label>
              <div class="input-group input-group-merge"> 
                  <select name="category_id" class="form-control">
                    <option disabled selected>Select Category ...</option>
                    @foreach ($categories as $item)
                      <option value="{{ $item->id }}" {{ $item->id == auth()->user()->category_id ? 'selected' : null}}>
                        {{ $item->cate_name }}
                      </option>
                    @endforeach
                  </select>
              </div>
            </div>
            
      
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Add Extra Email</label>
              <div class="input-group input-group-merge">
                <input
                  type="text"
                  id=""
                  name="extra_email"
                  type="email"
                  value="{{auth()->user()->extra_email}}"
                  class="form-control"/>
              </div>
            </div>
         
         

        </div>
        <div class="mt-2">
          <button type="submit" class="btn btn-primary me-2">Submit</button>
        </div>
      </form>
    </div>
    <!-- /Account -->
</div>

@endsection
@include('Student.inc.footer')