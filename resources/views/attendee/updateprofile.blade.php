@php
    $unis = App\Models\University::all();
@endphp

<!-- Main modal -->
<div id="profileModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed z-50 justify-center items-center w-full inset-0 h-ful backdrop-blur-md bg-slate-800 bg-opacity-10">
    <div class="flex flex-row items-center justify-center p-4 w-full h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 ">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Create Profile
                </h3>

                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </form>
            </div>

            <form id="updateForm" action="{{route('attendee.update')}}" method="post">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 required="">
                    </div>
                    <div>
                        <label for=" last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 required="">
                    </div>
                    <div>
                        <label for=" phone_no" class="block mb-2 text-sm font-medium text-gray-900 ">Contact No.</label>
                        <input type="phone_no" name="phone_no" id="phone_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 required="">
                    </div>
                    <div>
                        <label for=" uni" class="block mb-2 text-sm font-medium text-gray-900 ">University</label>
                        <select id="uni" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                            @foreach($unis as $uni)
                            <option value="{{$uni->id}}">{{$uni->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Address</label>
                        <input type="address" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 required="">
                    </div>
                    
                    <div class=" sm:col-span-2">
                        <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 ">Bio</label>
                        <textarea id="bio" name="bio" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 here"></textarea>
                    </div>
                </div>

                <button type="submit" class="text-black inline-flex items-center bg-blue-200 hover:bg-blue-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>