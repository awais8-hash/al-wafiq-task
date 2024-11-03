<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-50 flex items-center justify-center p-4">
      <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 space-y-6">
        <!-- Logo/Brand -->
        <div class="text-center space-y-2">
          <h1 class="text-3xl font-bold text-gray-900">Welcome back</h1>
          <p class="text-gray-500">Please sign in to continue</p>
        </div>

        <!-- Google Sign Up Button -->
        <button
          @click="signInWithGoogle"
          class="w-full flex items-center justify-center gap-3 px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
        >
          <img src="google.svg" class="w-5 h-5">
          Sign in with Google
        </button>
      </div>
    </div>
  </template>

<script>
export default {
    data() {
        return {
        }
    },
    methods: {
        signInWithGoogle(){
            window.location.href='/googleLogin'
        }
    },
};
</script>
