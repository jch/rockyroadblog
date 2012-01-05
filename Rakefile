task :deploy do
  puts "Deploying website..."
  system("rsync -avzh --delete #{File.expand_path('..', __FILE__)} jch@whatcodecraves.com:")
end