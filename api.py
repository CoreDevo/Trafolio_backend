import sys, ast
import urllib2
import json
import requests

face = bool(sys.argv[2])
indico_api = "cbb2eb36f1601a50824731f8375fd0f1"
clari_api = "04ZnUAOMjKKEzoRM6xJodCm0zqfvwO"
main_dict = {}

if face == True:
    data = {"data":sys.argv[1]}
    contents = requests.post("https://apiv2.indico.io/fer?key=" + indico_api, data).json()["results"]
    face_dict = {}
    for key in contents.keys():
        if contents[key] >= 0.17:
            face_dict[str(key)] = contents[key]
    main_dict["facial"] = face_dict

contents = urllib2.urlopen("https://api.clarifai.com/v1/tag?url=" +
                           sys.argv[1] +
                           "&access_token=" +
                           clari_api).read()
jsonContents = json.loads(contents)['results'][0]["result"]["tag"]
tags_dict = dict(zip(jsonContents["classes"], jsonContents["probs"]))
new_dict = {}
for item in tags_dict.keys():
    if tags_dict[item] > 0.95:
        new_dict[str(item)] = tags_dict[item]
  	
main_dict["landscape"] = new_dict

NSFW_contents = urllib2.urlopen("https://api.clarifai.com/v1/tag/" +
                           "?model=nsfw-v0.1" + "&url=" +
                           sys.argv[1] +
                           "&access_token=" +
                           clari_api).read()

NSFW_result = json.loads(NSFW_contents)['results'][0]["result"]["tag"]["probs"][1]
if NSFW_result < 0.1:
    main_dict["safety"] = "safe"
    main_dict["NSFW"] = NSFW_result
else:
    main_dict["safety"] = "unsafe"

ast.literal_eval(json.dumps(main_dict))

print(main_dict)
