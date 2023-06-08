<!-- Main modal -->
<div id="updateModal" name="Modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed z-50 justify-center items-center w-full inset-0 h-ful backdrop-blur-md bg-slate-800 bg-opacity-10">
    <div class="flex flex-row items-center justify-center p-4 w-full h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 ">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Update Profile
                </h3>

                <button name="m-close" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <form id="profileForm" action="{{route('university.update')}}" method="post">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="col-span-2">
                        <label for=" name" class="block mb-2 text-sm font-medium text-gray-900 ">University Name</label>
                        <input type="text" name="name" id="name" value={{$uni->name}} class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 required="">
                    </div>
                    <div>
                        <label for=" contact" class="block mb-2 text-sm font-medium text-gray-900 ">Contact No.</label>
                        <input type="contact" name="contact" value="{{$uni->contact}}" id="contact" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 required="">
                    </div>
                    <div>
                        <label for="social" class="block mb-2 text-sm font-medium text-gray-900 ">Social Link</label>
                        <input id="social"name="social" value="{{$uni->social_link}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                    </div>
                    <div class="col-span-2">
                        <label for="website" class="block mb-2 text-sm font-medium text-gray-900 ">Website</label>
                        <input id="website" name="website" value="{{$uni->website}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                    </div>
                    <div class="col-span-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Address</label>
                        <input type="address" name="address" id="address" value="{{$uni->address}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 required="">
                    </div>
                    
                    <div class=" sm:col-span-2">
                        <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                        <textarea id="desc" name="desc" rows="2"  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 here">{{$uni->description}}</textarea>
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