<div class="flex flex-col items-center">
    <div class="w-24 h-24 rounded-full border-4 border-indigo-500 avatar mb-6"></div>
    <h3 class="text-2xl font-bold text-gray-800 mb-4">User Details</h3>
    <div class="w-full space-y-4">
        <p class="flex justify-between text-gray-600">
            <span class="font-semibold">First Name:</span>
            <span>{{ $user->firstName }}</span>
        </p>
        <p class="flex justify-between text-gray-600">
            <span class="font-semibold">Last Name:</span>
            <span>{{ $user->lastName }}</span>
        </p>
        <p class="flex justify-between text-gray-600">
            <span class="font-semibold">Email:</span>
            <span>{{ $user->email }}</span>
        </p>
    </div>
</div>
<style>
    .avatar {
        background-image: url('https://i.pravatar.cc/150?u={{ $user->email }}');
        background-size: cover;
        background-position: center;
    }
</style>
