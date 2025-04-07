<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<section class="bg-gray-50 p-[100px]">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a class="navbar-brand" href="/client/home" style="font-size: 30px !important;">Vegefoods</a>
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h3 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Create an account
                </h3>
                <div class="space-y-4 md:space-y-6" action="#">
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Your Name</label>
                        <input v-model="formAdd.username" type="username" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Your name" required="">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                        <input v-model="formAdd.email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input v-model="formAdd.password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>
                    <div>
                        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                        <input type="confirm-password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300" required="">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="terms" class="font-light text-gray-500">I accept the <a class="font-medium text-primary-600 hover:underline" href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                    <button @click="handleSubmitAdd" type="submit" class="w-full text-white bg-[#82ae46] mb-3 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create an account</button>
                    <p class="text-sm font-light text-gray-500">
                        Already have an account? <a href="/client/login" class="font-medium text-primary-600 hover:underline">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
