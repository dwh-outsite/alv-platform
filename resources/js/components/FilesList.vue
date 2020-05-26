<template>
    <div v-if="files.length > 0" class="h-full flex items-center">
        <div v-for="file in files" :key="file.id" class="flex-1 bg-gray-700 hover:bg-gray-500 p-3 rounded m-1 text-center">
            <a :href="file.webViewLink" target="_blank" class="h-full" v-text="file.name" />
        </div>
    </div>
</template>

<script>
import GoogleDrive from '../GoogleDrive'

export default {
    props: ['folderId'],
    data() {
        return {
            files: []
        }
    },
    mounted() {
        GoogleDrive.listFiles(this.folderId).then(files => {
            this.files = files
        })
    }
}
</script>
