FROM ubuntu:20.04
ARG CLONE_ADDFLAG

WORKDIR /opt
COPY . /opt/uoj

RUN sed -i s@/archive.ubuntu.com/@/mirrors.tuna.tsinghua.edu.cn/@g /etc/apt/sources.list && apt-get clean && apt-get update
RUN cd uoj/install/judger && sh install.sh -p && echo "\
#!/bin/sh\n\
if [ ! -f \"/opt/uoj/judger/.conf.json\" ]; then\n\
  cd /opt/uoj/install/judger && sh install.sh -i\n\
fi\n\
service ntp start\n\
su judger -c \"/opt/uoj/judger/judge_client start\"\n\
exec bash\n" >/opt/up && chmod +x /opt/up

ENV LANG=C.UTF-8 TZ=Asia/Shanghai
EXPOSE 2333
CMD /opt/up
