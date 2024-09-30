import  moment from 'moment';

export default {
    name: 'General',

    methods: {
        formatDate(date) {
            //format date to "YYYY-MM-DD HH:mm:ss"
            return moment(date).format("YYYY-MM-DD HH:mm:ss");
        },
        //count arrays
        countArrays(array) {
            if(array){
                return array.length;
            }
            return 0;
            
        }  
    }
}
