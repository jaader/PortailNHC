# Portail NHC

You can run this code with Docker :

## How to build it ?

```bash
# To be executed in your project folder
docker build -t portail_nhc .
```

## How to launch it ?

```bash
docker run -p 80:80 -e NHC_IP=YOU_NHC_IP portail_nhc
```

The portail will be accessible on the port 80 on your Docker system
