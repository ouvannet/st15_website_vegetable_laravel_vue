<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<section class="bg-gray-50 pb-[50px]">
    <div class="flex flex-col items-center justify-center px-6 pb-6 mx-auto lg:py-0">
        <a class="navbar-brand" href="/client/home" style="font-size: 30px !important;">Vegefoods</a>
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h3 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Login
                </h3>
                <div class="space-y-4 md:space-y-6" action="#">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                        <input v-model="formAdd.email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input v-model="formAdd.password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>
                    <button @click="handleSubmitAdd" type="submit" class="w-full text-white bg-[#82ae46] mb-3 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create an account</button>
                    <p class="text-sm font-light text-gray-500">
                        Don't have an account? <a href="/client/register" class="font-medium text-primary-600 hover:underline">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
