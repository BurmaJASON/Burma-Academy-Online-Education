
import axios from "axios"

export default {
    data() {
        return {
            mailData : {
                name : '',
                email : '',
                subject : '',
                body : ''
            },
            validationErrors : null,
            success : null,
        }
    },
    methods : {
        sendMail() {
            axios.post('http://localhost:8000/api/mail',this.mailData)
                .then(response => {
                    this.mailData.name = '';
                    this.mailData.email = '';
                    this.mailData.subject = '';
                    this.mailData.body= '';
                    this.success = true;

                    return response.data;
                })
                .catch(error => {
                    if(error.response.status === 422) {
                        const $valerror = Object.values(error.response.data.errors)[0].shift();
                        this.validationErrors = $valerror;
                    }
                })
        }
    }
}