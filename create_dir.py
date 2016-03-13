import os,sys

newpath = sys.argv[1]
print(newpath)
try:
    if not os.path.exists(newpath):
        os.makedirs(newpath)
        print("Create Successfully")
    else:
        print("Create fail") 
except Exception as e:
    print(e)
