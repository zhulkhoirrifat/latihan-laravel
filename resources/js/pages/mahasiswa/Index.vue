<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Rocket } from 'lucide-vue-next';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';

interface Mahasiswa {
    id: number;
    name: string;
    nim: number;
    email: string;
}

interface Props {
    mahasiswa: Mahasiswa[];
}

//mendapatkan props dari inersia
const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Mahasiswa',
        href: '/mahasiswa',
    },
];
const page = usePage()

const handleDelete = (id: number) => {
    if(confirm('Apakah kamu ingin menghapus data mahasiswa?')){
        router.delete(route('mahasiswa.destroy', {id}))
    }
}
</script>

<template>

    <Head title="Mahasiswa" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div v-if="page.props.flash?.message" class="alert">
                <Alert class="bg-blue-200">
                    <Rocket class="h-4 w-4" />
                    <AlertTitle>Notifikasi</AlertTitle>
                    <AlertDescription>
                        {{ page.props.flash.message }}
                    </AlertDescription>
                </Alert>
            </div>
            <div>
                <Link :href="route('mahasiswa.create')"><Button>Tambah Mahasiswa</Button></Link>
            </div>
            <div>
                <Table>
                    <TableCaption>Daftar mahasiswa.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">
                                ID
                            </TableHead>
                            <TableHead>Nama</TableHead>
                            <TableHead>NIM</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead class="text-center">
                                Action
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="mahasiswa in props.mahasiswa" :key="mahasiswa.id">
                            <TableCell>{{ mahasiswa.id }}</TableCell>
                            <TableCell class="font-medium">{{ mahasiswa.name }}</TableCell>
                            <TableCell>{{ mahasiswa.nim }}</TableCell>
                            <TableCell>{{ mahasiswa.email }}</TableCell>
                            <TableCell class="text-center space-x-2">
                                <Link :href="route('mahasiswa.edit',{id: mahasiswa.id})"><Button class="bg-slate-600">Edit</Button></Link>
                                <Button class="bg-red-600" @click="handleDelete(mahasiswa.id)">Delete</Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
