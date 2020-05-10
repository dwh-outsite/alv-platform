import axios from 'axios'

export default class GoogleDrive {
    static listFiles(folderId) {
        return axios
            .get(
                `https://www.googleapis.com/drive/v3/files` +
                `?orderBy=name desc` +
                `&q='${folderId}'%20in%20parents` +
                `&fields=files(id, name, webContentLink, webViewLink, iconLink, thumbnailLink)` +
                `&key=AIzaSyABpb5AmlfMs5uREaBrCo3o8k4jwKf-jjo`
            )
            .then(response =>
                response.data.files.map(file => {
                    return {
                        ...file,
                        filename: file.name,
                        name: file.name.slice(0, file.name.lastIndexOf('.'))
                    }
                })
            )
    }
}
