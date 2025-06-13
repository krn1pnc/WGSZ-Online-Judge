INCLUDE_PATH = include
CXXFLAGS = -I./include -O2 --std=c++17 -Wall -lstdc++fs

EXE_CHECKER = \
	builtin/checker/lcmp \
	builtin/checker/casencmp \
	builtin/checker/rcmp6 \
	builtin/checker/dcmp \
	builtin/checker/rcmp4 \
	builtin/checker/casewcmp \
	builtin/checker/acmp \
	builtin/checker/fcmp \
	builtin/checker/rncmp \
	builtin/checker/icmp \
	builtin/checker/rcmp9 \
	builtin/checker/uncmp \
	builtin/checker/rcmp \
	builtin/checker/hcmp \
	builtin/checker/yesno \
	builtin/checker/caseicmp \
	builtin/checker/wcmp \
	builtin/checker/ncmp \
	builtin/checker/nyesno

EXE = main_judger \
	run/formatter \
	run/run_program \
	run/run_interaction \
	run/compile \
	builtin/judger/judger \
	$(EXE_CHECKER)

all: $(EXE)

% : %.cpp
	$(CXX) $(CXXFLAGS) $(EXTRA_CXXFLAGS) $< -o $@

run/formatter       : include/testlib.h
run/compile         : include/uoj_run.h

run/run_program     : run/run_program.cpp run/run_program_conf.h run/run_program_sandbox.h include/uoj_run.h
	$(CXX) $(CXXFLAGS) $< -o $@ -lseccomp -pthread

run/run_interaction : run/run_interaction.cpp include/uoj_run.h
	$(CXX) $(CXXFLAGS) $< -o $@ -pthread

builtin/judger/judger: include/*.h
main_judger: include/*.h

$(EXE_CHECKER): include/testlib.h

clean:
	rm -f $(EXE) $(OBJ)
