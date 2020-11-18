import Axios from "axios";

export const getProjectList = () => {

}


/**
 *
 * @param data
 */

export const storeNewProject = async (data) => {
    return await Axios.post("http://localhost/laravel/myTask/api/projects", data).then((res) => {
        return res.data;
    })
}
