<?php $this->layout('layout') ?>

<div
    class="h-full w-full flex flex-col gap-4"
    x-data="{ counter: 0 }"
>
    <div
        class="btn text-9xl flex-1"
        x-text="counter"
        @click="counter++; requestWakeLock()"
        @long-press.prevent="counter--"
        data-long-press-delay="1000"
    >
    </div>
    <div class="btn text-xl" @click="counter = 0" >RESET</div>
</div>

<script>
    var wakeLock = null;

    async function requestWakeLock() {
        if (wakeLock && !wakeLock.released) return;
        wakeLock = await navigator.wakeLock.request("screen");
    }
</script>

<style>
    body {
        height: 100vh; /* Fallback */
        height: 100svh;
        display: flex;
        flex-direction: column;
    }
    main {
        flex: 1;
    }
</style>