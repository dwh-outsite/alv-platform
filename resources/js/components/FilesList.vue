<template>
    <div v-if="files.length > 0">
        <div v-for="file in files" :key="file.id" class="w-full">
            <a :href="file.webViewLink" target="_blank">
                <div class="w-full bg-gray-700 hover:bg-gray-500 p-3 rounded my-1 flex items-center">
                    <div class="flex-1">{{ file.name }}</div>
                </div>
            </a>
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
