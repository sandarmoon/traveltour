<div>
    @if(!empty($successMsg))
    <div class="alert alert-success">
        {{ $successMsg }}
    </div>
    @endif
    {{-- list start --}}
     <div class="step-list d-flex  ">
       <div class="step-item flex-sm-grow-1 {{ $currentStep != 1 ? '' : 'active' }}">
           
        
           <a href="#step-1" 
                    class=" btn {{ $currentStep != 1 ? 'text-default' : 'text-primary' }}">
                    <span></span><font>Create Account</font>
                </a>
                  
       </div>

       <div class="step-item   flex-sm-grow-1 {{ $currentStep != 2 ? '' : 'active' }}">
            
            <a href="#step-2" 
                    class="btn {{ $currentStep != 2 ? 'text-default' : 'text-primary' }}">
                        <span></span><font>Part I</font>
                    </a>
           
       </div>

       <div class="step-item   flex-sm-grow-1 {{ $currentStep != 3 ? '' : 'active' }}">
           
           <a href="#step-3" 
                    class="btn {{ $currentStep != 3 ? 'text-default' : 'text-primary' }}"
                    disabled="disabled">
                        <span></span><font>Part II</font>
                    </a>
          
       </div>
   </div>
   {{-- list end --}}
   <div class="container col-md-8 m-auto">
        <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
            <div class="col-md-12">
                <h3> Sign up for Company Account</h3>
                <small>Already Sign up?  Sign In Here</small>
                <form wire:submit.prevent="firstStepSubmit">
                <div class="form-group mb-3">
                    <label for="username">Username:</label>@error('username') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="text" wire:model="username" class="form-control" id="username">
                    
                </div>
                
                <div class="form-group mb-3">
                    <label for="email">Email</label>@error('logo') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="email" wire:model="email" class="form-control" id="email" />
                    
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label> @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="password" wire:model="password" class="form-control"
                        id="password" required autocomplete="new-password" value="{{{ $info ?? '' }}}"/>
                   
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirmed Password</label> @error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="password" wire:model="password_confirmation" class="form-control"
                        id="password_confirmation" required  >
                   
                </div>
               
                <button type="submit" class="btn btn-outline-primary my-3 form-control"> Next</button>
            </form>
            </div>
        </div>

        <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
             <div class="col-md-12">
                <h3> General Information of Company </h3>
                <small>Please fill these questions!</small>
                <form wire:submit.prevent="secondStepSubmit">
                <div class="form-group mb-3">
                    <label for="name">Company Name:</label>@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="text" wire:model="name" class="form-control" id="name">
                    
                </div>
                @if ($logo)
                    Photo Preview:
                   <div class="">
                        <img src="{{ $logo->temporaryUrl() }}" class="img-thumbnail">
                   </div>
                @endif
                <div class="form-group mb-3">
                    <label for="logo">Company Logo</label>@error('logo') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="file" wire:model="logo" class="form-control" id="logo" />
                    
                </div>
                <div class="form-group mb-3">
                    <label for="license">Company License</label>@error('license') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="file" wire:model="license" class="form-control" id="license" />
                    
                </div>
                <div class="form-group mb-3">
                    <label for="info">Info:</label> @error('info') <span class="error text-danger">{{ $message }}</span> @enderror
                    <textarea type="text" wire:model="info" class="form-control"
                        id="info">{{{ $info ?? '' }}}</textarea>
                   
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Phone:</label> @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="text" wire:model="phone" class="form-control"
                        id="phone" >
                   
                </div>
                <div class="form-group">
                    <label for="address">Address:</label> @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                    <textarea type="text" wire:model="address" class="form-control"
                        id="address">{{{ $address ?? '' }}}</textarea>
                   
                </div>
                <button type="submit" class="btn btn-outline-primary my-3 form-control"> Next</button>
              </form>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h3 class="d-inline"> More Information Your Company </h3>
                    
                </div>
                {{-- form start here --}}
                <form wire:submit.prevent="secondStepSubmit">
                    <div class="row">
                       <div class="col form-group mb-3">
                            <label for="name">Company Name:</label>@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="name" class="form-control" id="name">
                            
                        </div>

                        <div class="col form-group mb-3">
                            <label for="ceo_name">Company CEO Name:</label>@error('ceo_name') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="eco_name" class="form-control" id="ceo_name">
                            
                        </div> 
                    </div>
                    
                    <hr class="my-2">
                    <h3 class="description small">InCharge Person Info</h3>
                    <div class="form-group mb-3">
                        <label for="incharge_name">Name</label>@error('incharge_name') <span class="error text-danger">{{ $message }}</span> @enderror
                        <input type="file" wire:model="incharge_name" class="form-control" id="incharge_name" />
                        
                    </div>
                    <div class="form-group mb-3">
                        <label for="incharge_position">Position:</label> @error('incharge_position') <span class="error text-danger">{{ $message }}</span> @enderror
                        <input type="text" wire:model="incharge_position" class="form-control"
                            id="incharge_position"/>
                       
                    </div>
                    <div class="form-group mb-3">
                        <label for="incharge_phone">Phone:</label> @error('incharge_phone') <span class="error text-danger">{{ $message }}</span> @enderror
                        <input type="text" wire:model="incharge_phone" class="form-control"
                            id="incharge_phone" >
                       
                    </div>
                    <hr class="my-3">
                    
                    <div class="d-flex justify-content-between">
                    <h3 class="description small">Company Service</h3>
                    {{-- <Button class="btn btn-primary  float-left btn-newsec"   wire:click="$emit('addmore')" >Add New Section</Button> --}}
                </div>
                    <h4 class="description small">
                        Service One
                    </h4>

                    <div class="d-flex justify-around mb-2">
                        
                        <div class="col-md-3">
                            <p class="small">Title</p>
                            <input type="text" name="service-label-one">
                        </div>  
                        <div class="col-md-8" wire:ignore>
                            <p class="small">Description</p>
                            <textarea name="service-desc-one" class="form-control summernote"></textarea>
                        </div>
                    </div>

                   <div class="d-flex justify-around mb-2">
                        
                        <div class="col-md-3">
                            <p class="small">Title</p>
                            <input type="text" name="service-label-one">
                        </div>  
                        <div class="col-md-8" wire:ignore>
                            <p class="small">Description</p>
                            <textarea name="service-desc-one" class="form-control summernote"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-around mb-2">
                        
                        <div class="col-md-3">
                            <p class="small">Title</p>
                            <input type="text" name="service-label-one">
                        </div>  
                        <div class="col-md-8" wire:ignore>
                            <p class="small">Description</p>
                            <textarea name="service-desc-one" class="form-control summernote"></textarea>
                        </div>
                    </div>
                      
                    <button type="submit" class="btn btn-outline-primary my-3 form-control"> Next</button>
                </form>
                {{-- form end here --}}
                <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
            </div>
        </div>
    </div>

</div>
@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // @this.set('summernote', contents);
        window.livewire.find('83b555bb3e243bc25f35')
        
    })
    
</script>
@endpush
