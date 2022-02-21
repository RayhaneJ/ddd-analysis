using Microsoft.EntityFrameworkCore;
using Wellcome.DataModel;

namespace Wellcome.Database
{
    public class WellcomeContext : DbContext
    {
        public WellcomeContext(DbContextOptions options) : base(options) { 
        }

        public DbSet<Host> Hosts { get; set; }
        public DbSet<Address> Addresses { get; set; }
        public DbSet<Contact> Contacts { get; set; }
        public DbSet<HostConfiguration> Configurations { get; set; }
        public DbSet<TravelersConfiguration> Travelers { get; set; }
        public DbSet<User> Users { get; set; }
        public DbSet<Feedback> Feedbacks { get; set; }
        public DbSet<HostPicture> HostPictures { get; set; }
        public DbSet<ProfilePicture> ProfilePictures { get; set; }
        public DbSet<FavoriteHost> FavoriteHosts { get; set; }
        public DbSet<HostReservation> HostReservations { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            OnHostCreating(modelBuilder);
            OnUserCreating(modelBuilder);
            OnHostConfigurationCreating(modelBuilder);
            OnFavoriteHostCreating(modelBuilder);
            OnHostReservationCreating(modelBuilder);    

            modelBuilder.Seed();
        }

        private static void OnHostCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Host>()
                .HasOne(s => s.HostPicture)
                .WithOne(ad => ad.Host)
                .HasForeignKey<HostPicture>(p => p.HostId);
        }

        private static void OnHostConfigurationCreating(ModelBuilder modelBuilder)
        {
            modelBuilder
                .Entity<HostConfiguration>()
                        .Property(e => e.Equipments)
                        .HasConversion(
                            v => string.Join(',', v),
                            v => v.Split(',', StringSplitOptions.RemoveEmptyEntries));
        }

        private static void OnFavoriteHostCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<FavoriteHost>().HasKey(sc => new { sc.UserId, sc.HostId });

            modelBuilder.Entity<FavoriteHost>()
                .HasOne(sc => sc.User)
                .WithMany(s => s.FavoriteHosts)
                .HasForeignKey(sc => sc.UserId).OnDelete(DeleteBehavior.Restrict);


            modelBuilder.Entity<FavoriteHost>()
                .HasOne(sc => sc.Host)
                .WithMany(s => s.FavoriteHosts)
                .HasForeignKey(sc => sc.HostId).OnDelete(DeleteBehavior.Restrict);
        }

        private static void OnHostReservationCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<HostReservation>().HasKey(sc => new { sc.UserId, sc.HostId });

            modelBuilder.Entity<HostReservation>()
                .HasOne(sc => sc.User)
                .WithMany(s => s.HostReservations)
                .HasForeignKey(sc => sc.UserId).OnDelete(DeleteBehavior.Restrict);
        }

        private static void OnUserCreating(ModelBuilder modelBuilder)
        {
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

            modelBuilder
               .Entity<User>()
                       .Property(e => e.Languages)
                       .HasConversion(
                           v => string.Join(',', v),
                           v => v.Split(',', StringSplitOptions.RemoveEmptyEntries));
        }
    }
}