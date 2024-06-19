<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div>
            <!-- Form -->
            <form>
                <div class="flex justify-center mt-5">
                <!-- Card -->
                <div class="p-4 sm:p-7 flex flex-col bg-white rounded-2xl shadow-lg dark:bg-gray-800">
                    <div class="text-center">
                        <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Registrar Categoría</h1>
                    </div>
                    <!-- Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Input Group -->
                        <div>
                        <!-- Floating Input -->
                        <div class="relative">
                            <input type="text" id="hs-hero-signup-form-floating-input-first-name" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                            focus:pt-6
                            focus:pb-2
                            [&:not(:placeholder-shown)]:pt-6
                            [&:not(:placeholder-shown)]:pb-2
                            autofill:pt-6
                            autofill:pb-2" placeholder="John">
                            <label for="hs-hero-signup-form-floating-input-first-name" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                            peer-focus:scale-90
                            peer-focus:translate-x-0.5
                            peer-focus:-translate-y-1.5
                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                            peer-[:not(:placeholder-shown)]:scale-90
                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 dark:text-neutral-500">First name</label>
                        </div>
                        <!-- End Floating Input -->
                        </div>
                        <!-- End Input Group -->
        
                        <!-- Input Group -->
                        <div>
                        <!-- Floating Input -->
                        <div class="relative">
                            <input type="text" id="hs-hero-signup-form-floating-input-last-name" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                            focus:pt-6
                            focus:pb-2
                            [&:not(:placeholder-shown)]:pt-6
                            [&:not(:placeholder-shown)]:pb-2
                            autofill:pt-6
                            autofill:pb-2" placeholder="Doe">
                            <label for="hs-hero-signup-form-floating-input-last-name" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                            peer-focus:scale-90
                            peer-focus:translate-x-0.5
                            peer-focus:-translate-y-1.5
                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                            peer-[:not(:placeholder-shown)]:scale-90
                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 dark:text-neutral-500">Last name</label>
                        </div>
                        <!-- End Floating Input -->
                        </div>
                        <!-- End Input Group -->
        
                        <!-- Input Group -->
                        <div>
                        <!-- Floating Input -->
                        <div class="relative">
                            <input type="email" id="hs-hero-signup-form-floating-input-email" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                            focus:pt-6
                            focus:pb-2
                            [&:not(:placeholder-shown)]:pt-6
                            [&:not(:placeholder-shown)]:pb-2
                            autofill:pt-6
                            autofill:pb-2" placeholder="you@email.com">
                            <label for="hs-hero-signup-form-floating-input-email" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                            peer-focus:scale-90
                            peer-focus:translate-x-0.5
                            peer-focus:-translate-y-1.5
                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                            peer-[:not(:placeholder-shown)]:scale-90
                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 dark:text-neutral-500">Email</label>
                        </div>
                        <!-- End Floating Input -->
                        </div>
                        <!-- End Input Group -->
        
                        <!-- Input Group -->
                        <div>
                        <!-- Floating Input -->
                        <div class="relative">
                            <input type="text" id="hs-hero-signup-form-floating-input-company-name" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                            focus:pt-6
                            focus:pb-2
                            [&:not(:placeholder-shown)]:pt-6
                            [&:not(:placeholder-shown)]:pb-2
                            autofill:pt-6
                            autofill:pb-2" placeholder="Preline">
                            <label for="hs-hero-signup-form-floating-input-company-name" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                            peer-focus:scale-90
                            peer-focus:translate-x-0.5
                            peer-focus:-translate-y-1.5
                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                            peer-[:not(:placeholder-shown)]:scale-90
                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 dark:text-neutral-500">Company name</label>
                        </div>
                        <!-- End Floating Input -->
                        </div>
                        <!-- End Input Group -->
        
                        <!-- Input Group -->
                        <div class="relative col-span-full">
                        <!-- Floating Input -->
                        <div class="relative">
                            <input type="password" id="hs-hero-signup-form-floating-input-new-password" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                            focus:pt-6
                            focus:pb-2
                            [&:not(:placeholder-shown)]:pt-6
                            [&:not(:placeholder-shown)]:pb-2
                            autofill:pt-6
                            autofill:pb-2" placeholder="********">
                            <label for="hs-hero-signup-form-floating-input-new-password" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                            peer-focus:scale-90
                            peer-focus:translate-x-0.5
                            peer-focus:-translate-y-1.5
                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                            peer-[:not(:placeholder-shown)]:scale-90
                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 dark:text-neutral-500">New password</label>
                        </div>
                        <!-- End Floating Input -->
        
                        <div id="hs-strong-password-popover" class="hidden absolute z-10 w-full bg-gray-100 rounded-lg p-4 dark:bg-neutral-950">
                            <div id="hs-strong-password-in-popover" data-hs-strong-password='{
                                "target": "#hs-hero-signup-form-floating-input-new-password",
                                "hints": "#hs-strong-password-popover",
                                "stripClasses": "hs-strong-password:opacity-100 hs-strong-password-accepted:bg-teal-500 h-2 flex-auto rounded-full bg-blue-500 opacity-50 mx-1",
                                "mode": "popover"
                            }' class="flex mt-2 -mx-1">
                            </div>
        
                            <h4 class="mt-3 text-sm font-semibold text-gray-800 dark:text-white">
                            Your password must contain:
                            </h4>
        
                            <ul class="space-y-1 text-sm text-gray-500 dark:text-neutral-500">
                            <li data-hs-strong-password-hints-rule-text="min-length" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                <span class="hidden" data-check>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                </span>
                                <span data-uncheck>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                Minimum number of characters is 6.
                            </li>
                            <li data-hs-strong-password-hints-rule-text="lowercase" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                <span class="hidden" data-check>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                </span>
                                <span data-uncheck>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                Should contain lowercase.
                            </li>
                            <li data-hs-strong-password-hints-rule-text="uppercase" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                <span class="hidden" data-check>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                </span>
                                <span data-uncheck>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                Should contain uppercase.
                            </li>
                            <li data-hs-strong-password-hints-rule-text="numbers" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                <span class="hidden" data-check>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                </span>
                                <span data-uncheck>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                Should contain numbers.
                            </li>
                            <li data-hs-strong-password-hints-rule-text="special-characters" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                <span class="hidden" data-check>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                </span>
                                <span data-uncheck>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                Should contain special characters.
                            </li>
                            </ul>
                        </div>
                        </div>
                        <!-- End Input Group -->
        
                        <!-- Input Group -->
                        <div class="col-span-full">
                        <!-- Floating Input -->
                        <div class="relative">
                            <input type="password" id="hs-hero-signup-form-floating-input-current-password" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                            focus:pt-6
                            focus:pb-2
                            [&:not(:placeholder-shown)]:pt-6
                            [&:not(:placeholder-shown)]:pb-2
                            autofill:pt-6
                            autofill:pb-2" placeholder="********">
                            <label for="hs-hero-signup-form-floating-input-current-password" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                            peer-focus:scale-90
                            peer-focus:translate-x-0.5
                            peer-focus:-translate-y-1.5
                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                            peer-[:not(:placeholder-shown)]:scale-90
                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 dark:text-neutral-500">Current password</label>
                        </div>
                        <!-- End Floating Input -->
                        </div>
                        <!-- End Input Group -->
                    </div>
                    <!-- End Grid -->
        
                    <div class="mt-5">
                        <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Guardar
                        </button>
                    </div>
                </div>
                <!-- End Card -->
                </div>
            </form>
            <!-- End Form -->
        </div>
    </AuthenticatedLayout>
</template>