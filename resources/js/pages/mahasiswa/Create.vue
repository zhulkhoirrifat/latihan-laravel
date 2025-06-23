<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tambah Mahasiswa',
        href: '/mahasiswa/create',
    },
];

const form = useForm({
    name: '',
    nim: '',
    email: '',
})

const handleSubmit = () => {
    form.post(route('mahasiswa.store'));
}
</script>

<template>
    <Head title="Tambah Mahasiswa" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                <div class="space-y-2">
                    <Label for="Nama Mahasiswa">Nama</Label>
                    <Input v-model="form.name" type="text" placeholder="Nama Mahasiswa" />
                    <div class="text-sm text-red-600" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div class="space-y-2">
                    <Label for="NIM">NIM</Label>
                    <Input v-model="form.nim" type="number" placeholder="NIM" />
                    <div class="text-sm text-red-600" v-if="form.errors.nim">{{ form.errors.nim }}</div>
                </div>
                <div class="space-y-2">
                    <Label for="Email">Email</Label>
                    <Input v-model="form.email" type="email" placeholder="Email" />
                    <div class="text-sm text-red-600" v-if="form.errors.email">{{ form.errors.email }}</div>
                </div>
                <Button type="submit" :disabled="form.processing">Simpan</Button>
            </form>
        </div>
    </AppLayout>
</template>
