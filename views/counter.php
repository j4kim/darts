<?php $this->layout('layout') ?>

<div
    class="h-full w-full flex flex-col gap-4"
    x-data="{ counter: 1 }"
>
    <div
        class="btn text-9xl flex-1"
        x-text="counter"
        @click="counter++"
    >
    </div>
    <div class="flex gap-4 justify-between">
        <div class="btn text-2xl flex-1" @click="counter = 1" >1</div>
        <div class="btn text-2xl flex-1" @click="counter--" >-1</div>
    </div>
</div>

<script>
    navigator.wakeLock.request("screen")
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