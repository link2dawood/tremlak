<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" ></script>
</head>
<body>


<div class="container">
        <h2>API Table</h2>
        <table>
            <tr>
                <th>API Name</th>
                <th>API Description</th>
                <th>Action</th>
            </tr>
            <tr>
                <td><div id="apiName1">Country Info</div></td>
                <td>
                    <div id="apiDesc1">
                        Country information : Capital, Population, Area in square km,
                        Bounding Box of mainland (excluding offshore islands)
                    </div>
                </td>
                <td>
                    <button class="submitbtn1" >Submit</button>
                </td>
            </tr>
            <tr>
                <td><div id="apiName2">Streetname Lookup Webservice</div></td>
                <td>
                    <div id="apiDesc2">
                        Street name look up 
                    </div>
                </td>
                <td>
                    <button class="submitbtn2" >Submit</button>
                </td>
            </tr>
            <tr>
                <td><div id="apiName3">Weather Observation</div></td>
                <td>
                    <div id="apiDesc3">
                        Get weather observation details 
                    </div>
                </td>
                <td>
                    <button class="submitbtn3" >Submit</button>
                </td>
            </tr>
           
        </table>
        <div class="results">
            <p style="font-size: 22px red" id="loader">Loading ...</p>
            <div id="results"></div>
       
        </div>
    </div>

    




 <script src="./script.js"></script>
    
</body>
</html>