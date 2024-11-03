<template>
    <div class="min-h-screen bg-gray-50 p-4">
        <!-- User Profile Section -->
        <div class="absolute top-4 right-4 flex items-center space-x-4">
            <div class="text-right">
                <p class="text-sm font-medium text-gray-900">{{ user.name }}</p>
                <p class="text-xs text-gray-500">{{ user.email }}</p>
                <a href="/signOut"><i class="fas fa-sign-out-alt"></i></a>
            </div>
            <div class="relative">
                <button
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ userInitials }}
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex items-center justify-center mt-16">
            <div class="w-full max-w-lg bg-white rounded-lg shadow-md">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900">Website Performance Tester</h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Enter a URL and device type to test website performance
                    </p>
                </div>

                <!-- Form Content -->
                <div class="p-6">
                    <form @submit.prevent="handleSubmit" class="space-y-6">
                        <!-- URL Input -->
                        <div>
                            <label for="url" class="block text-sm font-medium text-gray-700">
                                Website URL
                            </label>
                            <input v-model="siteData.url" type="text" placeholder="https://example.com"
                                @input="score = null"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                :class="{ 'border-red-500': validationError }" />
                        </div>

                        <!-- Device Type Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Device Type
                            </label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" v-model="siteData.platform" value="desktop"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 text-blue-600" />
                                    <span class="ml-2">Desktop</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" v-model="siteData.platform" value="mobile"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 text-blue-600" />
                                    <span class="ml-2">Mobile</span>
                                </label>
                            </div>
                        </div>

                        <!-- Error Message -->
                        <div v-if="error" class="bg-red-50 border-l-4 border-red-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ error }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" :disabled="loading"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50">
                            <template v-if="loading">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Testing Performance...
                            </template>
                            <template v-else>
                                Test Performance
                            </template>
                        </button>

                        <!-- Performance Score -->
                        <div v-if="score !== null" class="mt-6 text-center">
                            <div class="text-2xl font-bold mb-2">Performance Score</div>
                            <div class="text-5xl font-bold text-blue-600">
                                {{ score }}
                                <span class="text-lg text-gray-500">/100</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: ['user'],
    data() {
        return {
            siteData: {
                url: '',
                platform: 'desktop',
            },
            loading: false,
            error: '',
            score: null,
            validationError: false,
        }
    },
    computed: {
        userInitials() {
            return this.user.name
                .split(' ')
                .map(name => name[0])
                .join('')
                .toUpperCase();
        }
    },
    methods: {
        validateUrl(url) {
            try {
                new URL(url)
                return true
            } catch {
                return false
            }
        },
        handleSubmit() {
            this.error = ''
            this.score = null
            this.validationError = false

            if (!this.siteData.url.trim()) {
                this.error = 'Please enter a URL'
                this.validationError = true
                return
            }

            if (!this.validateUrl(this.siteData.url)) {
                this.error = 'Please enter a valid URL (e.g., https://example.com)'
                this.validationError = true
                return
            }

            this.loading = true
            axios.post('/performance/test', this.siteData)
                .then(response => {
                    this.score = response.data.score
                    this.loading = false
                })
                .catch(err => {
                    this.error = err.data.error
                    this.loading = false
                })

        }
    },
}
</script>

<style scoped></style>
