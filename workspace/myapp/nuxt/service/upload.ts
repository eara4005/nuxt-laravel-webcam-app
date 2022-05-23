import axios, { AxiosResponse } from 'axios'

export interface ImgRequest {
  img:HTMLImageElement
}

export class BookService {
  async postImgData(imgRequest: ImgRequest) {
    await axios.post('/api/upload', imgRequest)
  }
}