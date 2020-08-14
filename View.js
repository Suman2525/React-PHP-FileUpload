import React from 'react';
import swal from 'sweetalert';
import axios from 'axios';

class ViewForm extends React.Component {
    constructor() {
        super();
        this.state = {
            imgArr: []
        }
    }
    componentDidMount() {
        axios.get('http://localhost/suman_php/CIfullStack/SignUpController/getFile')
            .then(response => {

                if (response.data.success == 1) {
                    let imgArr = response.data.fileData;
                    this.setState({ imgArr }, () => {
                        console.log(this.state.imgArr);
                        // this.renderImages;
                    })

                }
            })
            .catch(err => {
                console.log(err);
            })
    }

    // renderImages=(e)=>{
    //     this.state.imgArr.map((img,index)=>{
    //         return(
    //             <ul>
    //                 <li>
    //                     <img src={"http://localhost/suman_php/CIfullStack/uploads/"+index}></img>
    //                 </li>
    //             </ul>
    //         );
    //     })
    // }

    render() {
        return (
            <React.Fragment>
                
                {
                    this.state.imgArr.map((img,i) => {
                        return (
                            <ul>
                                <img src={"http://localhost/suman_php/CIfullStack/uploads/" + img.documents}></img>
                            </ul>
                        );
                    })
                }
            </React.Fragment>
        );
    }
}

export default ViewForm;