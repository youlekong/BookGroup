
export function ylTrim(s){
    if (typeof s === 'string') {
        return s.replace(/^\s+|\s+$/g,"")
    } else {
        return 'not string'
    }
}