<template>
    <div class="container mx-auto h-full">
        <div class="h-full min-h-screen flex items-center">
            <div class="mx-auto">
                <logo></logo>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from "@/js/Pages/Shared/Logo/Logo";
//
export default {
    name: "Home",
    //
    components: {
        Logo,
    },
};
</script>
