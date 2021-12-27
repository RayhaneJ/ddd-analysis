using Microsoft.EntityFrameworkCore;
using Wellcome.DataModel;

namespace Wellcome.Database
{
    public class WellcomeContext : DbContext
    {
        public DbSet<Host> Hosts { get; set; }
        public DbSet<Address> Addresses { get; set; }
        public DbSet<Contact> Contacts { get; set; }
        public DbSet<HostConfiguration> Configurations { get; set; }
        public DbSet<TravelersConfiguration> Travelers { get; set; }
        public DbSet<User> Users { get; set; }
        public DbSet<Feedback> Feedbacks { get; set; }
        public DbSet<HostPicture> HostPictures { get; set; }
        public DbSet<ProfilePicture> ProfilePictures { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            OnHostCreating(modelBuilder);
            OnUserCreating(modelBuilder);

            modelBuilder.Seed();
        }

        private static void OnHostCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Host>()
                .HasOne(s => s.HostPicture)
                .WithOne(ad => ad.Host)
                .HasForeignKey<HostPicture>(p => p.HostId);
        }

        private static void OnUserCreating(ModelBuilder modelBuilder)
        {
            modelBuilder
                .Entity<User>()
                        .Property(e => e.Languages)
                        .HasConversion(
                            v => string.Join(',', v),
                            v => v.Split(',', StringSplitOptions.RemoveEmptyEntries));
            modelBuilder
                .Entity<User>()
                .Property(e => e.Gender)
                .HasConversion(
                    v => v.ToString(),
                    v => (Gender)Enum.Parse(typeof(Gender), v));

            modelBuilder.Entity<User>()
                .HasOne(s => s.ProfilePicture)
                .WithOne(ad => ad.User)
                .HasForeignKey<ProfilePicture>(p => p.UserId);
        }
    }
}