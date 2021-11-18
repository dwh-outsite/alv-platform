<template>
    <div v-if="files.length > 0" class="h-full md:flex items-center">
        <a
            v-for="file in files"
            :key="file.id"
            :href="file.webViewLink"
            v-text="file.name"
            target="_blank"
            class="block bg-gray-700 hover:bg-gray-500 p-3 rounded m-1 text-center"
        />
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
