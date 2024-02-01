<?php $this->layout('layout') ?>

<div
    class="h-full w-full flex flex-col gap-4"
    x-data="{ counter: 1 }"
>
    <button
        class="btn text-9xl flex-1"
        x-text="counter"
        @click="counter++; requestWakeLock()"
    >
    </button>
    <div class="flex gap-4 justify-between">
        <button class="btn text-2xl flex-1" @click="counter = 1" >1</button>
        <button class="btn text-2xl flex-1" @click="counter--" >-1</button>
    </div>
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
        height: 100dvh;
        display: flex;
        flex-direction: column;
    }
    main {
        flex: 1;
    }
</style>