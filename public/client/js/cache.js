export class CacheManager{
    constructor(key){
        this.key=key;
    }
    getList(){
        const list=localStorage.getItem(this.key);
        return list?JSON.parse(list):{};
    }
    addData(data){
        const list=this.getList();
        list[data.id]=data;
        list[data.id].qty=1;
        this.saveData(list);
    }
    saveData(data){
        localStorage.setItem(this.key,JSON.stringify(data));
    }
    removeData(index){
        const list=this.getList();
        delete list[index]
        this.saveData(list);
    }
    removeAllData(){
        this.saveData({});
    }
    increaseQty(index){
        const list=this.getList();
        if(list[index].qty<list[index].stock_quantity){
            list[index].qty++;
        }else{
            return false;
        }
        this.saveData(list);
        return true;
    }
    decreaseQty(index){
        const list=this.getList();
        if(list[index].qty>1){
            list[index].qty--;
        }
        this.saveData(list);
    }
    editQty(index,qty){
        const list=this.getList();
        if(list[index].qty<=list[index].stock_quantity){
            list[index].qty=qty;
        }else{
            return false;
        }
        this.saveData(list);
        return true;
    }
    checkExist(data){
        const list=this.getList();
        if(list[data.id]){
            return true;
        }
        return false;
    }
}
