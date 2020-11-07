export default {
    data() {
        return {

        }
    },
    methods: {
        async callApi(method, url, data) {
            if(method == "get"){
                try {
                    return await axios({
                        method: method,
                        url: url,
                        params: data,
                    });
                } catch (e) {
                    return e.response
                }   
            }else{
                try {
                    return await axios({
                        method: method,
                        url: url,
                        data: data,
                    });
                } catch (e) {
                    return e.response
                }  
            }
           
        },
        productImage(path) {
            return '/uploads/product/' + path;
        },
        formatNumber(number){
            return Intl.NumberFormat().format(number)
        },
    },
}